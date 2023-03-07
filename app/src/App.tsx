import React from 'react';
import { QueryClient, QueryClientProvider } from '@tanstack/react-query';
import {
  Outlet,
  RootRoute,
  Route,
  Router,
  RouterProvider,
} from '@tanstack/react-router';
import Navbar from './components/navbar/Navbar';
import Homepage from './components/homepage/Homepage';
import TournamentsSelector from './components/tournaments/TournamentsSelector';
import StandingsSelector from './components/standings/StandingsSelector';

const rootRoute = new RootRoute({
  component: () => {
    return (
      <>
        <Outlet />
      </>
    );
  },
});

const indexRoute = new Route({
  getParentRoute: () => rootRoute,
  path: '/',
  component: () => {
    return <Homepage />;
    // return <HelloTailwind />;
  },
});

const scheduleRoute = new Route({
  getParentRoute: () => rootRoute,
  path: 'schedule',
  component: () => {
    return <div>schedule</div>;
    // return <JSONPlaceholderPhoto photoId={20} />;
  },
  errorComponent: () => 'Oh crap!',
});

const tournamentsRoute = new Route({
  getParentRoute: () => rootRoute,
  path: 'tournaments',
  component: () => {
    return <TournamentsSelector tournamentId={76} />;
    // return <JSONPlaceholderPhoto photoId={20} />;
  },
  errorComponent: () => 'Oh crap!',
});

const standingsRoute = new Route({
  getParentRoute: () => rootRoute,
  path: 'standings',
  component: () => {
    return <StandingsSelector />;
    // return <JSONPlaceholderPhoto photoId={20} />;
  },
  errorComponent: () => 'Oh crap!',
});

const routeTree = rootRoute.addChildren([
  indexRoute,
  scheduleRoute,
  tournamentsRoute,
  standingsRoute,
]);

// Set up a Router instance
const router = new Router({
  routeTree,
  defaultPreload: 'intent',
});

declare module '@tanstack/react-router' {
  interface Register {
    router: typeof router;
  }
}

const queryClient = new QueryClient();

function App() {
  return (
    <QueryClientProvider client={queryClient}>
      <Navbar />
      <RouterProvider router={router} />
      {/*<ReactQueryDevtools />*/}
    </QueryClientProvider>
  );
}

export default App;
