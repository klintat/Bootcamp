import { useState } from "react";
import { Link, Outlet } from "react-router-dom";
function NavBar({ token }) {

    const [currentPage, setCurrentPage] = useState(window.location.pathname);
    return (
        <>
            <nav className="navbar navbar-expand navbar-light bg-light">
                <div className="collapse navbar-collapse">
                    <ul className="navbar-nav mr-auto">
                        <li className={currentPage === "/" ? "nav-item nav-item-active" : "nav-item"}>
                            <Link to={"/?token=" + token} onClick={() => { setCurrentPage("/") }}>Artists</Link>
                        </li>
                        <li className={currentPage === "/albums" ? "nav-item nav-item-active" : "nav-item"}>
                            <Link to={"/albums?token=" + token} onClick={() => { setCurrentPage("/albums") }}>Albums</Link>
                        </li>
                        <li className={currentPage === "/tracks" ? "nav-item nav-item-active" : "nav-item"}>
                            <Link to={"/tracks?token=" + token} onClick={() => { setCurrentPage("/tracks") }}>Tracks</Link>
                        </li>
                    </ul>
                </div>
            </nav>
            <Outlet></Outlet>
        </>
    )

}

export default NavBar;