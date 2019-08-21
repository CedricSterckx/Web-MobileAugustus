import React, {useEffect, useState} from 'react';
import logo from './logo.svg';
import './App.css';
import Recipe from './Recipe';
import {BrowserRouter as Router, Switch, Route} from 'react-router-dom';

function RecipeDetail ({ match})  {
    const APP_ID = '46c7915b';
    const APP_KEY = '9ca077922ea864cb2ba7e55ff30a1ae5';

    const [recipes, setRecipes] = useState([]);
    useEffect(() => {
        getRecipes();
    }, []);

    const getRecipes = async () => {
        const response = await fetch(`https://api.edamam.com/search?q=${match.params.name}&app_id=${APP_ID}&app_key=${APP_KEY}`);
        const data = await response.json();
        console.log(data);
        setRecipes(data.hits)
    };


    return (
       <div>
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

export default RecipeDetail;