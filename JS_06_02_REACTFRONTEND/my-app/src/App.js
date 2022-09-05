import './App.css';
import NavBar from './NavBar';
import HomePage from './pages/HomePage';
import React from 'react';
import LoadPage from './pages/LoadPage';
import EditPage from './pages/EditPage';
import { BrowserRouter, Route, Routes } from 'react-router-dom';

class App extends React.Component {

  constructor() {
    super();
    this.state = {
      pageDisplayed: "HomePage"
    }
  }

  openPage = (pageName) => {
    this.setState({ pageDisplayed: pageName });
  }

  render() {
    return (
      <div className="App container">
        <BrowserRouter>
          <Routes>
            <Route path='/' element={<NavBar></NavBar>}>
              <Route index element={<HomePage></HomePage>}></Route>
              <Route path='loadPage' element={<LoadPage></LoadPage>}></Route>
              <Route path='editPage' element={<EditPage></EditPage>}></Route>
            </Route>
          </Routes>
        </BrowserRouter>

        {/* <NavBar openPage={this.openPage}></NavBar>
        {this.state.pageDisplayed === "HomePage" && <HomePage />}
        {this.state.pageDisplayed === "LoadPage" && <LoadPage />} */}
      </div>
    );
  }
}

export default App;