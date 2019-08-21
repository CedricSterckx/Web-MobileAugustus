import React from 'react';
import {Link} from 'react-router-dom';
import {Button, Card, CardActions, CardText, CardTitle} from 'react-mdl';

const Recipe = ({title, calories, image, ingredients}) => {
    return (
        <div>
            <Card shadow={0} style={{width: '320px', height: '320px', margin: 'auto'}}>
                <CardTitle expand style={{
                    color: '#fff',
                    background: `url(${image}) bottom right 15% no-repeat #46B6AC`
                }}>{title}</CardTitle>
                <CardText>
                    {calories} calories
                </CardText>
                <CardActions border>
                    <Link to={`/detail/${title}`}>
                        <Button type="submit">See detail</Button>
                    </Link>
                </CardActions>
            </Card>
        </div>
    );
};

export default Recipe;