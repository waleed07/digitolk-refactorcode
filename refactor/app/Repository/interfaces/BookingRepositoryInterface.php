<?php

namespace App\Repositories\Interfaces;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Symfony\Component\HttpFoundation\JsonResponse;
use Illuminate\Http\Request;

interface BookingRepositoryInterface extends EloquentRepositoryInterface
{
    public function getUsersJobs(int $user_id) : JsonResponse;
    public function getUsersJobsHistory(int $user_id, Request $request) : JsonResponse;
    public function storeJobEmail(array $data) : JsonResponse;
}
