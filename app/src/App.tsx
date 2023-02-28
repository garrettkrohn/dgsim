import React from 'react';
import { QueryClient, QueryClientProvider } from '@tanstack/react-query';
import { ReactQueryDevtools } from '@tanstack/react-query-devtools';
import {
  Link,
  Outlet,
  RootRoute,
  Route,
  Router,
  RouterProvider,
} from '@tanstack/react-router';
import Navbar from './components/navbar/Navbar';

const rootRoute = new RootRoute({
  component: () => {
    return (
      <>
        <Navbar />
        <div className="container mx-auto mt-5 w-96 bg-black text-lg text-amber-50">
          <Link
            to="/"
            activeProps={{
              className: 'font-bold underline',
            }}
            activeOptions={{ exact: true }}
          >
            Hello Tailwind
          </Link>
          {' | '}
          <Link
            to="/photos"
            activeProps={{
              className: 'font-bold underline',
            }}
          >
            Photos
          </Link>
        </div>
        <div className="container mx-auto mt-10 w-96">
          <Outlet />
          <div className="mt-5">
            {/*<JotaiComponent />*/}
            {/*<ZustandComponent />*/}
          </div>
        </div>
      </>
    );
  },
});

const indexRoute = new Route({
  getParentRoute: () => rootRoute,
  path: '/',
  component: () => {
    return <div>test</div>;
    // return <HelloTailwind />;
  },
});

const photosRoute = new Route({
  getParentRoute: () => rootRoute,
  path: 'photos',
  component: () => {
    return <div>test2</div>;
    // return <JSONPlaceholderPhoto photoId={20} />;
  },
  errorComponent: () => 'Oh crap!',
});

const routeTree = rootRoute.addChildren([indexRoute, photosRoute]);

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
      <RouterProvider router={router} />
      <ReactQueryDevtools />
    </QueryClientProvider>
  );
}

export default App;
