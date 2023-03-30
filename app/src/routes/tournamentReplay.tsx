import { Route } from '@tanstack/react-router';
import rootRoute from './rootRoute';
import Admin from '../components/admin/Admin';
import Error from '../util/Error';
import React from 'react';
import Replay from '../components/Replay/Replay';

const tournamentReplayRoute = new Route({
  getParentRoute: () => rootRoute,
  path: 'replay',
  component: () => {
    return <Replay />;
  },
  errorComponent: () => <Error />,
});

export default tournamentReplayRoute;
