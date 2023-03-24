import { Route } from '@tanstack/react-router';
import Homepage from '../components/homepage/Homepage';
import React from 'react';
import rootRoute from './rootRoute';

const indexRoute = new Route({
  getParentRoute: () => rootRoute,
  path: '/',
  component: () => {
    return <Homepage />;
  },
});

export default indexRoute;
