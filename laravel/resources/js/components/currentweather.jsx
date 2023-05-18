import React, { useEffect, useState } from 'react';

const WeatherDisplay = () => {
  const [weatherData, setWeatherData] = useState(null);
  const [localTime, setLocalTime] = useState(null);

  useEffect(() => {
    fetch('/api/weatherdata')
      .then((response) => response.json())
      .then((data) => {
        if (data) {
          setWeatherData(data);
          setLocalTime(getLocalTime());
        } else {
          console.error('Error: Data is null');
        }
      })
      .catch((error) => console.error('Error:', error));
  }, []);

    const getLocalTime = () => {
    const currentDate = new Date();
    const gmtOffset = currentDate.getTimezoneOffset() / 60; // GMT offset in hours
    const localTime = new Date(currentDate.getTime() + gmtOffset * 3600000); // Adjust the time based on the offset

    return localTime.toUTCString();
  };

  return (
    <div>
      {weatherData ? (
        <>
          <h2>Weather Information</h2>
          <p>Location: {weatherData.location}</p>
          <p>Local Time (GMT): {localTime}</p>
          <p>Temperature: {weatherData.temperature}°C</p>
          <p>Humidity: {weatherData.humidity}%</p>
          <p>Description: {weatherData.description}</p>
        </>
      ) : (
        <p>Loading weather data...</p>
      )}
    </div>
  );
};

export default WeatherDisplay;
