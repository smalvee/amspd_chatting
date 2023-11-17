<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Events\TestEvent;

class TestEventController extends Controller
{
    function testEvents()
    {
        event(new TestEvent);
    }
}
