<div class="app-fixed-search d-flex align-items-center">
    <div class="sidebar-toggle d-block d-lg-none ml-1">
        <i data-feather="menu" class="font-medium-5"></i>
    </div>
    <div class="d-flex align-content-center justify-content-between w-100">
        <div class="input-group input-group-merge">
            <div class="input-group-prepend">
                <span class="input-group-text"><i data-feather="search" class="text-muted"></i></span>
            </div>
            <input type="text" class="form-control" id="todo-search" placeholder="Search task" aria-label="Search..."
                aria-describedby="todo-search" />
        </div>
    </div>
    <div class="dropdown">
        <a href="javascript:void(0);" class="dropdown-toggle hide-arrow mr-1" id="todoActions" data-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false">
            <i data-feather="more-vertical" class="font-medium-2 text-body"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="todoActions">
            <a class="dropdown-item sort-asc" href="javascript:void(0)">Sort A - Z</a>
            <a class="dropdown-item sort-desc" href="javascript:void(0)">Sort Z - A</a>
            <a class="dropdown-item" href="javascript:void(0)">Sort Assignee</a>
            <a class="dropdown-item" href="javascript:void(0)">Sort Due Date</a>
            <a class="dropdown-item" href="javascript:void(0)">Sort Today</a>
            <a class="dropdown-item" href="javascript:void(0)">Sort 1 Week</a>
            <a class="dropdown-item" href="javascript:void(0)">Sort 1 Month</a>
        </div>
    </div>
</div>
