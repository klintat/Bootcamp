import { useState } from "react";
import { Link, Outlet } from "react-router-dom";
function NavBar() {

    const [currentPage, setCurrentPage] = useState(window.location.pathname);
    return (
        <>
            <nav className="navbar navbar-expand navbar-light bg-light">
                <div className="collapse navbar-collapse">
                    <ul className="navbar-nav mr-auto">
                        <li className={currentPage === "/" ? "nav-item nav-item-active" : "nav-item"}>
                            <Link to="/" onClick={() => { setCurrentPage("/") }}>Artists</Link>
                        </li>
                    </ul>
                </div>
            </nav>
            <Outlet></Outlet>
        </>
    )

}

export default NavBar;