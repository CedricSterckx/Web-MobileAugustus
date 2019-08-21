import React, {useEffect, useState} from 'react';
import logo from './logo.svg';
import './App.css';
import Recipe from './Recipe';
import {BrowserRouter as Router, Switch, Route} from 'react-router-dom';
import { ToastContainer, toast } from 'react-toastify';
import 'react-toastify/dist/ReactToastify.css';
import {Textfield, Button} from 'react-mdl';


const RecipeList = () => {

    const APP_ID = '46c7915b';
    const APP_KEY = '9ca077922ea864cb2ba7e55ff30a1ae5';

    const [recipes, setRecipes] = useState([]);
    const [search, setSearch] = useState('');
    const [query, setQuery] = useState('Chicken');

    useEffect(() => {
        getRecipes();
    }, [query]);

    const notify = () => toast("Data fetched !");

    const getRecipes = async () => {
        const response = await fetch(`https://api.edamam.com/search?q=${query}&app_id=${APP_ID}&app_key=${APP_KEY}`);
        const data = await response.json();
        console.log(data);
        setRecipes(data.hits);
        notify();
    };

    const updateSearch = e => {
        setSearch(e.target.value)
    };

    const getSearch = e => {
        e.preventDefault();
        setQuery(search);
        setSearch('');
    }

    return (
        <div className="App">
            <ToastContainer />
            <br/>
            <form onSubmit={getSearch} className="search-form">
                <input className="search-bar" type="text" value={search} onChange={updateSearch} />
                <Button className="search-button" type="submit">Search</Button>
            </form>
            <br/>
            {recipes.map(recipe => (
                <Recipe
                    key={recipe.recipe.label}
                    title={recipe.recipe.label} calories={recipe.recipe.calories}
                    image={recipe.recipe.image}
                    ingredients={recipe.recipe.ingredients}

                />
            ))}
        </div>
    )
};


export default RecipeList;
