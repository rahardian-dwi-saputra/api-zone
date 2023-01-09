<?php

namespace App\Policies;

use App\Models\Customer;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class CustomerPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Customer $customer){
        if($user->is_admin)
            return true;
        else
            return $user->id == $customer->user_id ? Response::allow() : Response::deny('You do not own this customer.');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Customer $customer){
        if($user->is_admin)
            return true;
        else
            return $user->id == $customer->user_id ? Response::allow() : Response::deny('You do not own this customer.');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Customer $customer){
        if($user->is_admin)
            return true;
        else
            return $user->id == $customer->user_id ? Response::allow() : Response::deny('You do not own this customer.');
    }

}