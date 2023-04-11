import { Route } from '@tanstack/react-router';
import rootRoute from './rootRoute';
import React from 'react';
import ProfilePage from '../components/profilePage/ProfilePage';

const profilePageRoute = new Route({
  getParentRoute: () => rootRoute,
  path: '/profile',
  component: () => {
    return <ProfilePage />;
  },
});

export default profilePageRoute;
