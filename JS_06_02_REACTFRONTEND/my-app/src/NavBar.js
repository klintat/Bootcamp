import { Link, Outlet } from "react-router-dom";
// function NavBar({ openPage }) {
    function NavBar() {
    return (
        <>
            <nav className="navbar navbar-expand navbar-light bg-light">
                <div className="collapse navbar-collapse">
                    <ul className="navbar-nav mr-auto">
                        <li className="nav-item active">
                            <Link to="/">Home</Link>
                            {/* <button className="btn" onClick={() => openPage("HomePage")}>Home</button> */}
                        </li>
                        <li className="nav-item">
                            <Link to="/loadPage">Load Page</Link>
                            {/* <button className="btn" onClick={() => openPage("LoadPage")}>Load from file</button> */}
                        </li>
                    </ul>
                </div>
            </nav>
            <Outlet></Outlet>
        </>
    )

}

export default NavBar;