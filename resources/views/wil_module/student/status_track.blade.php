@extends('layouts.app')

@section('title', 'STATUS TRACKING')

@section('content')

<!-- Responsive Table -->
<div class="card" style="margin: 15px; border-radius: 30px;">

  <h5 class="card-header">
    My WIL Application
  </h5>

  <div class="table-responsive text-nowrap">

    <table class="table">

      <thead>

        <tr class="text-nowrap">

          <th>Application ID</th>
          <th>Course</th>
          <th>Date Submitted</th>
          <th>Status</th>

        </tr>

      </thead>

      <tbody class="table-border-bottom-0">

    @if($application)

        <tr>

            <td>
                #{{ $application->user_id }}
            </td>

            <td>
                {{ $application->field_of_study }}
            </td>

            <td>
                {{ $application->created_at->format('d M Y') }}
            </td>

            <td>

                <span class="badge bg-warning">

                    {{ ucfirst($application->status) }}

                </span>

            </td>

        </tr>

    @else

        <tr>

            <td colspan="4" class="text-center">

                No application found

            </td>

        </tr>

    @endif

</tbody>

    </table>

  </div>

</div>
<!--/ Responsive Table -->


@endsection
