import './App.css';
import NavBar from './components/NavBar';
import React, { useEffect } from 'react';
import { BrowserRouter, Route, Routes } from 'react-router-dom';
import ArtistsPage from './pages/ArtistsPage';
import { useState } from 'react';
import AlbumsPage from './pages/AlbumsPage';
import TracksPage from './pages/TracksPage';

function App() {

  const [token, setToken] = useState("");

  useEffect(() => {
    const queryString = window.location.search;
    const params = new URLSearchParams(queryString);
    const token = params.get("token");
    setToken(token);
  })

  return (
    <div className="App">
      {(token === "" || token === null) &&
        <a href={process.env.REACT_APP_HOST + '/login'}>Login</a>
      }
      {(token !== "" && token !== null) && <div className='container'>
        <BrowserRouter>
          <Routes>
            <Route path="/" element={<NavBar token={token}></NavBar>}>
              <Route index element={<ArtistsPage token={token}></ArtistsPage>}></Route>
              <Route path="albums" element={<AlbumsPage token={token}></AlbumsPage>}></Route>
              <Route path='tracks' element={<TracksPage token={token}></TracksPage>}></Route>
            </Route>
          </Routes>
        </BrowserRouter>
      </div>
      }
    </div>
  );
}

export default App;