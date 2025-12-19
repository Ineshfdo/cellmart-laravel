<?php

namespace App\Livewire;

use App\Models\Feedback;
use Livewire\Component;

class ContactForm extends Component
{
    public $name = '';
    public $email = '';
    public $phone = '';
    public $subject = '';
    public $message = '';

    protected $rules = [
        'name' => 'required|string|min:2',
        'email' => 'required|email',
        'phone' => 'nullable|string|max:20',
        'subject' => 'required|string|min:3',
        'message' => 'required|string|min:10',
    ];

    public function submit()
    {
        $this->validate();

        Feedback::create([
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'subject' => $this->subject,
            'message' => $this->message,
        ]);

        session()->flash('success', 'Thank you for your message! We will get back to you soon.');

        $this->reset();
        $this->dispatch('form-submitted');
    }

    public function render()
    {
        return view('livewire.contact-form');
    }
}
