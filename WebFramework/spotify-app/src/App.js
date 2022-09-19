import './App.css';
import NavBar from './components/NavBar';
import React, { useEffect } from 'react';
import { BrowserRouter, Route, Routes } from 'react-router-dom';
import ArtistsPage from './pages/ArtistsPage';

function App() {

  useEffect(() => {
    const queryString = window.location.search;
    const params = new URLSearchParams(queryString);
    const token = params.get("token");
  })

  return (
    <div className="App">

      <div className='container'>
        <BrowserRouter>
          <Routes>
            <Route path='/' element={<NavBar></NavBar>}>
              <Route index element={<ArtistsPage></ArtistsPage>}></Route>
            </Route>
          </Routes>
        </BrowserRouter>
      </div>
    </div>
  );
}

export default App;