<?php

namespace App\Livewire\Frontend;

use App\Models\Agenda;
use Livewire\Component;
use Livewire\WithPagination;
use Carbon\Carbon;

class AgendasPage extends Component
{
    use WithPagination;

    public $currentMonth;
    public $currentYear;
    public $selectedDate;

    public function mount()
    {
        $this->currentMonth = now()->month;
        $this->currentYear = now()->year;
    }

    public function previousMonth()
    {
        $date = Carbon::create($this->currentYear, $this->currentMonth, 1)->subMonth();
        $this->currentMonth = $date->month;
        $this->currentYear = $date->year;
        $this->selectedDate = null;
    }

    public function nextMonth()
    {
        $date = Carbon::create($this->currentYear, $this->currentMonth, 1)->addMonth();
        $this->currentMonth = $date->month;
        $this->currentYear = $date->year;
        $this->selectedDate = null;
    }

    public function selectDate($date)
    {
        $this->selectedDate = $this->selectedDate === $date ? null : $date;
        $this->resetPage();
    }

    public function render()
    {
        $featuredEvent = Agenda::where('is_featured', true)->latest()->first();

        // Get all events for the current viewed month to show indicators on the calendar
        $monthEvents = Agenda::whereYear('start_date', $this->currentYear)
            ->whereMonth('start_date', $this->currentMonth)
            ->get();

        // Generate calendar days
        $daysInMonth = Carbon::create($this->currentYear, $this->currentMonth, 1)->daysInMonth;
        $firstDayOfWeek = Carbon::create($this->currentYear, $this->currentMonth, 1)->dayOfWeek; // 0 (Sun) to 6 (Sat)
        
        $calendar = [];
        // Pad empty days before the 1st
        for ($i = 0; $i < $firstDayOfWeek; $i++) {
            $calendar[] = null;
        }
        // Fill actual days
        for ($i = 1; $i <= $daysInMonth; $i++) {
            $dateString = Carbon::create($this->currentYear, $this->currentMonth, $i)->format('Y-m-d');
            $hasEvent = $monthEvents->where('start_date', '>=', $dateString . ' 00:00:00')
                                    ->where('start_date', '<=', $dateString . ' 23:59:59')
                                    ->count();
            
            $calendar[] = [
                'day' => $i,
                'date' => $dateString,
                'hasEvent' => $hasEvent > 0
            ];
        }

        // Get events for the list (filtered by selected date, or upcoming from today)
        $eventsQuery = Agenda::query();
        
        if ($this->selectedDate) {
            $eventsQuery->whereDate('start_date', $this->selectedDate);
        } else {
            // Show upcoming events in general if no specific date is selected
            $eventsQuery->where('start_date', '>=', now()->startOfDay());
        }

        $events = $eventsQuery->orderBy('start_date', 'asc')->paginate(5);

        return view('livewire.frontend.agendas-page', [
            'featuredEvent' => $featuredEvent,
            'calendar' => $calendar,
            'events' => $events,
        ])->layout('components.layouts.app', ['title' => 'Agendas - Lembur Sawah']);
    }
}