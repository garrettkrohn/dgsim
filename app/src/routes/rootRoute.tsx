import { Outlet, RootRoute } from '@tanstack/react-router';
import PageLayout from '../components/PageLayout';
import React from 'react';

const rootRoute = new RootRoute({
  component: () => {
    return (
      <>
        <PageLayout>
          <Outlet />
        </PageLayout>
      </>
    );
  },
});

export default rootRoute;
