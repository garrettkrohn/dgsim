import { Route } from '@tanstack/react-router';
import TournamentsSelector from '../components/tournaments/TournamentsSelector';
import React from 'react';
import rootRoute from './rootRoute';
import Error from '../util/Error';

const tournamentsRoute = new Route({
  getParentRoute: () => rootRoute,
  path: 'tournaments',
  component: () => {
    return <TournamentsSelector />;
  },
  errorComponent: () => <Error />,
});
