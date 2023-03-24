import { Route } from '@tanstack/react-router';
import StandingsSelector from '../components/standings/StandingsSelector';
import React from 'react';
import rootRoute from './rootRoute';
import Error from '../util/Error';

const standingsRoute = new Route({
  getParentRoute: () => rootRoute,
  path: 'standings',
  component: () => {
    return <StandingsSelector />;
  },
  errorComponent: () => <Error />,
});

export default standingsRoute;
