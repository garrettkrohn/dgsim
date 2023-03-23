import { Route } from '@tanstack/react-router';
import Admin from '../components/admin/Admin';
import React from 'react';
import rootRoute from './rootRoute';
import Error from '../util/Error';

const adminRoute = new Route({
  getParentRoute: () => rootRoute,
  path: 'admin',
  component: () => {
    return <Admin />;
  },
  errorComponent: () => <Error />,
});

export default adminRoute;
