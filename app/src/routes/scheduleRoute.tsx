import { Route } from '@tanstack/react-router';
import React from 'react';
import rootRoute from './rootRoute';
import Error from '../util/Error';

const scheduleRoute = new Route({
  getParentRoute: () => rootRoute,
  path: 'schedule',
  component: () => {
    return <div>schedule</div>;
  },
  errorComponent: () => <Error />,
});

export default scheduleRoute;
