<?php

namespace App\Livewire;

use App\Models\dataService;
use App\Models\User;
use Illuminate\Validation\Rule;
use Livewire\Component;

class CreateService extends Component
{
    public $cabangs;
    public $nama_servis;
    public $code;
    public $jenis_servis;
    public $harga;
    public $garansi_1;
    public $garansi_3;
    public $garansi_2;

    public $harga_khusus = [] ;
    public $garansi_1_khusus = [];
    public $garansi_2_khusus = [];
    public $garansi_3_khusus = [];
    // public $status = 1;
    


    public function mount($cabangs)
    {
        $this->cabangs = $cabangs;        
    }

    public function render()
    {
        return view('livewire.create-service');
    }
    public function updatedHargaKhusus($value, $key)
    {        
        // Ketika harga diubah, update array harga_khusus
        $this->harga_khusus[$key] = $value;
    }



    public function submit()
    {                           
        $cabangs = User::role('cabang')->pluck('id');  
        $user_id = $cabangs->first() ;
        $validated = $this->validate([
            'nama_servis' => 'required|string|min:3',
            'code' => [
                'required',
                'string',
                'min:3',
                Rule::unique('data_services', 'code')->where('user_id', $user_id),
            ],
            'jenis_servis' => 'required',            
            'harga' => 'required|integer',
            'garansi_1' => 'nullable|integer',
            'garansi_2' => 'nullable|integer',
            'garansi_3' => 'nullable|integer',
        ]);        
        foreach ($cabangs as $cabang) {
            $save = $validated;
            $save['status'] = 1 ;
            $save['user_id'] = $cabang;
            if (isset($this->harga_khusus[$cabang])) {
                $save['harga'] = $this->harga_khusus[$cabang];
            }
            if (isset($this->garansi_1_khusus[$cabang])) {
                $save['garansi_1'] = $this->garansi_1_khusus[$cabang];
            }
            if (isset($this->garansi_2_khusus[$cabang])) {
                $save['garansi_2'] = $this->garansi_2_khusus[$cabang];
            }   
            if (isset($this->garansi_3_khusus[$cabang])) {
                $save['garansi_3'] = $this->garansi_3_khusus[$cabang];
            }            
            dataService::create($save);
        }

        $this->resetForm();
        session()->flash('message', 'Berhasil menambahkan servis');
        
        // return redirect()->back()->with('success', 'Data service berhasil ditambahkan!');
    }

    public function resetForm()
    {
        $this->nama_servis = null;
    $this->code = null;
    $this->jenis_servis = null;
    $this->harga = null;
    $this->garansi_1 = null;
    $this->garansi_3 = null;
    $this->garansi_2 = null;
    $this->harga_khusus = [] ;
    $this->garansi_1_khusus = [];
    $this->garansi_2_khusus = [];
    $this->garansi_3_khusus = [];
    }
}
