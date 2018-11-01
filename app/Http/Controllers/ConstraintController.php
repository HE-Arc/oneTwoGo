<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ConstraintController extends Controller
{
    public function random()
    {
        $nbConstraints = 6;
        $allconstraints = ["a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k"];
        $randomconstraints = [];
        for($i = 0; $i < $nbConstraints; $i++)
        {
            $id = rand(0, sizeof($allconstraints) - 1);
            $randomconstraints[] = $allconstraints[$id];
            unset($allconstraints[$id]);
            $allconstraints = array_values($allconstraints);
        }
        $_SESSION['constraints'] = $allconstraints;
        return $randomconstraints;
    }
}
