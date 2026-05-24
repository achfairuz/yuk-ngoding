<?php

namespace App\Livewire\Contacts;

use App\Models\contact as Contact;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

#[Title('Contact Inbox')]
class Index extends Component
{
    use WithPagination;

    public string $search = '';

    public string $projectType = '';

    public function updatedSearch(): void
    {
        $this->resetPage();
    }

    public function updatedProjectType(): void
    {
        $this->resetPage();
    }

    public function delete(string $id): void
    {
        Contact::findOrFail($id)->delete();

        $this->resetPage();

        session()->flash('contact_status', __('Brief berhasil dihapus.'));
    }

    public function contactHref(Contact $contact): string
    {
        $contactValue = trim($contact->contact);

        if (filter_var($contactValue, FILTER_VALIDATE_EMAIL)) {
            return 'mailto:' . $contactValue;
        }

        $phoneNumber = preg_replace('/\D+/', '', $contactValue);

        if (str_starts_with($phoneNumber, '0')) {
            $phoneNumber = '62' . substr($phoneNumber, 1);
        }

        if (str_starts_with($phoneNumber, '8')) {
            $phoneNumber = '62' . $phoneNumber;
        }

        return $phoneNumber ? 'https://wa.me/' . $phoneNumber : '#';
    }

    public function isContactPhone(Contact $contact): bool
    {
        return ! filter_var(trim($contact->contact), FILTER_VALIDATE_EMAIL)
            && $this->contactHref($contact) !== '#';
    }

    public function render(): View
    {
        $query = Contact::query()
            ->when($this->search !== '', function ($query): void {
                $search = '%' . $this->search . '%';

                $query->where(function ($query) use ($search): void {
                    $query
                        ->where('name', 'like', $search)
                        ->orWhere('contact', 'like', $search)
                        ->orWhere('project_type', 'like', $search)
                        ->orWhere('message', 'like', $search)
                        ->orWhere('id', 'like', $search);
                });
            })
            ->when($this->projectType !== '', function ($query): void {
                $query->where('project_type', $this->projectType);
            });

        return view('contacts.index', [
            'contacts' => $query->latest()->paginate(10),
            'contactCount' => Contact::count(),
            'filteredContactCount' => (clone $query)->count(),
            'latestContact' => Contact::latest()->first(),
            'projectTypes' => Contact::query()
                ->select('project_type')
                ->distinct()
                ->orderBy('project_type')
                ->pluck('project_type'),
        ]);
    }
}
