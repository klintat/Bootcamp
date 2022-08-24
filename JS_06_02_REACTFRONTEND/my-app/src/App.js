import './App.css';
import NavBar from './NavBar';
import HomePage from './pages/HomePage';
import React from 'react';
import LoadPage from './pages/LoadPage';

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
      <div className="App">
        <NavBar openPage={this.openPage}></NavBar>
        {this.state.pageDisplayed === "HomePage" && <HomePage />}
        {this.state.pageDisplayed === "LoadPage" && <LoadPage />}
      </div>
    );
  }
}

export default App;