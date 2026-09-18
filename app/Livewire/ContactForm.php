<?php

namespace App\Livewire;

use App\Models\ContactInquiry;
use Livewire\Component;

class ContactForm extends Component
{
    public $name = '';
    public $email = '';
    public $subject = '';
    public $body = '';
    public $successMessage = '';

    protected $rules = [
        'name'    => 'required|min:3|max:100',
        'email'   => 'required|email|max:150',
        'subject' => 'required|min:3|max:200',
        'body'    => 'required|min:10|max:3000',
    ];

    public function submit()
    {
        $this->validate();

        ContactInquiry::create([
            'name'    => $this->name,
            'email'   => $this->email,
            'subject' => $this->subject,
            'body'    => $this->body,
            'status'  => 'new',
        ]);

        $this->reset(['name', 'email', 'subject', 'body']);
        $this->successMessage = app()->getLocale() === 'sw'
            ? 'Asante sana! Ujumbe wako umepokelewa na timu yetu itawasiliana nawe hivi karibuni.'
            : 'Thank you! Your inquiry has been received and our team will get back to you shortly.';
    }

    public function render()
    {
        return view('livewire.contact-form');
    }
}
