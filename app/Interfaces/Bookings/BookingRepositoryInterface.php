<?php


namespace App\Interfaces\Bookings;


interface BookingRepositoryInterface
{
    public function index();
    public function show($id);
    public function destroy($id);
}
