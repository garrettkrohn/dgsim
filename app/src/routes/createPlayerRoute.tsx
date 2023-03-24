import { Route } from '@tanstack/react-router';
import CreatePlayer from '../components/CreatePlayer/CreatePlayer';
import React from 'react';
import rootRoute from './rootRoute';
import Error from '../util/Error';

const createPlayerRoute = new Route({
  getParentRoute: () => rootRoute,
  path: 'create',
  component: () => {
    return <CreatePlayer />;
  },
  errorComponent: () => <Error />,
});

export default createPlayerRoute;
