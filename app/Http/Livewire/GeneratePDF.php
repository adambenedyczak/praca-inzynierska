<?php

namespace App\Http\Livewire;

use App\Models\Element;
use Livewire\Component;
use App\Models\ObjectModel;


class GeneratePDF extends Component
{
    public $object_id;

    public $setParts = false;
    public $setOverviews = false;
    public $setInsurances = false;
    public $setHistory = false;

    public function generate() {
        $this->setParts = ($this->setParts == true)? 1 : 0;
        $this->setOverviews = ($this->setOverviews == true)? 1 : 0;
        $this->setInsurances = ($this->setInsurances == true)? 1 : 0;
        $this->setHistory = ($this->setHistory == true)? 1 : 0;

        return redirect()
                ->route('pdf.index', [
                        'id' => $this->object_id, 
                        'p' => $this->setParts,
                        'o' => $this->setOverviews,
                        'i' => $this->setInsurances,
                        'h' => $this->setHistory
                    ]);
      }

    public function render()
    {
        return view('livewire.generate-p-d-f');
    }
}
