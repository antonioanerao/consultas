<div class="left side-menu">
    <div class="sidebar-inner slimscrollleft">
        <div id="sidebar-menu">
            <ul>
                <li class="menu-title">{{ env('APP_NAME') }}</li>

                <li>
                    <a href="{{ route('dashboard') }}" class="waves-effect waves-primary">
                        <i class="ti-home"></i><span> Dashboard </span>
                    </a>
                </li>

                <li class="has_sub">
                    <a href="javascript:void(0);" class="waves-effect waves-primary">
                        <i class="ti-list"></i><span> Consultas </span>
                        <span class="menu-arrow"></span>

                    </a>
                    <ul class="list-unstyled">
                        <li><a href="{{ route('consulta.create') }}">Cadastrar</a></li>
                    </ul>
                </li>

                <li class="has_sub">
                    <a href="javascript:void(0);" class="waves-effect waves-primary">
                        <i class="ti-user"></i><span> Menu 02</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul class="list-unstyled">
                        <li><a href="">Sub 01</a></li>
                    </ul>
                </li>
            </ul>
            <div class="clearfix"></div>
        </div>
    </div>
</div>
