import React, { useState } from 'react';
import '@css/Home.css';
import Search from '@components/search.jsx';
import WeatherDisplay from '@components/currentweather.jsx';

const Home = () => {

    const handleOnSearchChange = (searchData) => {
        const [lat, lon] = searchData.value.split(" ");
        console.log([lat, lon]);
    }

    return (
        <div className="container">
            <Search onSearchChange={handleOnSearchChange} />
            <WeatherDisplay />
        </div>
    )
}

export default Home
