import React, {useEffect, useState} from 'react';
import logo from './logo.svg';
import './App.css';
import Recipe from './Recipe';
import {BrowserRouter as Router, Switch, Route} from 'react-router-dom';
import RecipeList from "./RecipeList";
import RecipeDetail from "./RecipeDetail";

const App = () => {
    return (
        <Router>
            <div className="App">
                <Switch>
                    <Route path="/" exact component={RecipeList}/>
                    <Route path="/detail" exact component={RecipeDetail}/>
                    <Route path="/detail/:name" component={RecipeDetail} />
                </Switch>
            </div>
        </Router>
    )
};


export default App;
