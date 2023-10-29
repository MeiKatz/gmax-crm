<div class="dropdown-menu dropdown-menu-demo">
  <span class="dropdown-header">Menu</span>
  <a class="dropdown-item" href="{{ route('projects.show', [ $project ]) }}">
    <x-icon.invoice style="margin-right: 10px;" />
    <span>Overview</span>
  </a>
  <a class="dropdown-item" href="{{ route('projects.tasks.index', [ $project ]) }}">
    <x-icon.task style="margin-right: 10px;" />
    <span>Tasks</span>
  </a>
  <a class="dropdown-item" href="{{ route('projects.note.show', [ $project ]) }}">
    <x-icon.note style="margin-right: 10px;" />
    <span>Notes</span>
  </a>
  <a class="dropdown-item" href="{{ route('projects.expenses.index', [ $project ]) }}">
    <x-icon.expense style="margin-right: 10px;" />
    <span>Expenses</span>
  </a>
</div>
