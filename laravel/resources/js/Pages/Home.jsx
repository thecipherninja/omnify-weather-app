import React, { useState } from 'react';
import '@css/Home.css';
import Search from '@components/search.jsx';

const Home = () => {

    const handleOnSearchChange = (searchData) => {
        console.log(searchData);
    }

    return (
        <div className="container">
            <Search onSearchChange={handleOnSearchChange} />
        </div>
    )
}

export default Home
