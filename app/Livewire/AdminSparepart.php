<?php

namespace App\Livewire;

use App\Models\sparepart;
use App\Models\User;
use Doctrine\Inflector\Rules\English\Rules;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Log;

class AdminSparepart extends Component
{
    public $cabangs;
    public $nama_sparepart;
    public $harga;
    public $code;
    public $harga_beli;

    public $harga_khusus = [];

    public function render()
    {
        return view('livewire.admin-sparepart');
    }

    public function submit()
    {
        // dd($this);
        $cabangs = User::role('cabang')->pluck('id');
        $user_id = $cabangs->first();
        $validated = $this->validate([
            'nama_sparepart' => 'required|string|min:2',
            'code' => [
                'required',
                'string',
                'min:3',
                Rule::unique('spareparts', 'code')->where('user_id', $user_id),
            ],
            'harga' => 'required|integer',
            'harga_beli'=> 'required|integer'
        ]);
        foreach ($cabangs as $cabang) {
            $save = $validated;
            $save['status'] = 1;
            $save['user_id'] = $cabang;
            if (isset($this->harga_khusus[$cabang])) {
                $save['harga'] = (int) str_replace('.', '', $this->harga_khusus[$cabang]);
            }
            if (isset($this->harga[$cabang])) {
                $save['harga'] = (int) str_replace('.', '', $this->harga[$cabang]);
            }
            sparepart::create($save);
        }
        $this->resetForm();
        session()->flash('message', 'Berhasil menambahkan sparepart');

    }
    public function mount($cabangs)
    {
        $this->cabangs = $cabangs;
    }
    public function updated($propertyName, $value)
    {
        Log::info("Updated property: {$propertyName} with value: {$value}");
        $value_format = str_replace('.', '', $value);
        if (strpos($propertyName, 'harga_khusus') !== false || strpos($propertyName, 'garansi_1_khusus') !== false || strpos($propertyName, 'garansi_2_khusus') !== false || strpos($propertyName, 'garansi_3_khusus') !== false || strpos($propertyName, 'harga') !== false || strpos($propertyName, 'garansi_1') !== false || strpos($propertyName, 'garansi_2') !== false || strpos($propertyName, 'garansi_3') !== false) {
            Log::info("AFTER FORMATED Updated property: {$propertyName} with value: {$value_format}");
            $this->$propertyName = (int) $value_format;
        }
    }
    public function resetForm()
    {
        $this->nama_sparepart = null;
        $this->code = null;
        $this->harga = null;
        $this->harga_beli = null;
        $this->harga_khusus = [];

    }
}
