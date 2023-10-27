<div class="dropdown-menu dropdown-menu-demo">
  <span class="dropdown-header">Menu</span>
  <a class="dropdown-item" href="/project/{{$prid}}">
    <x-icon.invoice style="margin-right: 10px;" />
    <span>Overview</span>
  </a>
  <a class="dropdown-item" href="/project/tasks/{{$prid}}" >
    <x-icon.task style="margin-right: 10px;" />
    <span>Tasks</span>
  </a>
  <a class="dropdown-item" href="/project/note/{{$prid}}" >
    <x-icon.note style="margin-right: 10px;" />
    <span>Notes</span>
  </a>
  <a class="dropdown-item" href="/project/expenses/{{$prid}}">
    <x-icon.expense style="margin-right: 10px;" />
    <span>Expenses</span>
  </a>
</div>
