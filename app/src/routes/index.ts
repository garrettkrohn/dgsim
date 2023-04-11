import createPlayerRoute from './createPlayerRoute';
import adminRoute from './adminRoute';
import tournamentsRoute from './tournamentRoute';
import indexRoute from './indexRoute';
import scheduleRoute from './scheduleRoute';
import standingsRoute from './standingsRoute';
import rootRoute from './rootRoute';
import tournamentReplayRoute from './tournamentReplay';
import { Router } from '@tanstack/react-router';
import profilePageRoute from './profilePageRoute';

const routeTree = rootRoute.addChildren([
  indexRoute,
  scheduleRoute,
  tournamentsRoute,
  standingsRoute,
  adminRoute,
  createPlayerRoute,
  tournamentReplayRoute,
  profilePageRoute,
]);

export const router = new Router({
  routeTree,
  defaultPreload: 'intent',
});
