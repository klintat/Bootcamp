function NavBar({ openPage }) {

    return (
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <button className="btn" onClick={() => openPage("HomePage")}>Home</button>
                    </li>
                    <li class="nav-item">
                        <button className="btn" onClick={() => openPage("LoadPage")}>Load from file</button>
                    </li>
                </ul>
            </div>
        </nav>
    )

}

export default NavBar;