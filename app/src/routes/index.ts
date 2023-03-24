import createPlayerRoute from './createPlayerRoute';
import adminRoute from './adminRoute';
import tournamentsRoute from './tournamentRoute';
import indexRoute from './indexRoute';
import scheduleRoute from './scheduleRoute';
import standingsRoute from './standingsRoute';
import rootRoute from './rootRoute';
import { Router } from '@tanstack/react-router';

const routeTree = rootRoute.addChildren([
  indexRoute,
  scheduleRoute,
  tournamentsRoute,
  standingsRoute,
  adminRoute,
  createPlayerRoute,
]);

export const router = new Router({
  routeTree,
  defaultPreload: 'intent',
});
