<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Interfaces\Bookings\BookingRepositoryInterface;

class BookingController extends Controller
{
    private $booking;

    public function __construct(BookingRepositoryInterface $booking)
    {
        $this->booking = $booking;
    }
    public function index()
    {
        //
        return $this->booking->index();
    }

    public function show($id)
    {
        //
        return $this->booking->show($id);
    }

    public function destroy(string $id)
    {
        //
        return $this->booking->destroy($id);
    }
}
