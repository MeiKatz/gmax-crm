<?php

namespace App\Models\Project;

enum Status: string {
  case NOT_STARTED = 'not started';
  case IN_PROGRESS = 'in progress';
  case IN_REVIEW   = 'in review';
  case ON_HOLD     = 'on hold';
  case COMPLETED   = 'completed';
  case CANCELLED   = 'cancelled';
}
