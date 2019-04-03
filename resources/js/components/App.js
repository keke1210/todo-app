import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import { BrowserRouter, Route, Switch } from 'react-router-dom';
import Header from './src/Header';
import NewProject from './src/NewProject';
import ProjectsList from './src/ProjectsList';
import SingleProject from './src/SingleProject';


class App extends Component {
  render () {
    return (
      <BrowserRouter>
        <div>
          <Header />
          <Switch>
            <Route exact path='/' component={ProjectsList} />
            <Route path='/create' component={NewProject} />
            <Route path='/:id' component={SingleProject} />
          </Switch>
        </div>
      </BrowserRouter>
    )
  }
}

ReactDOM.render(<App />, document.getElementById('app'));