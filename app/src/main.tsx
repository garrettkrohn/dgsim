import React from 'react';
import ReactDOM from 'react-dom/client';
import App from './App';
import './index.css';
import { Auth0Provider } from '@auth0/auth0-react';

ReactDOM.createRoot(document.getElementById('root') as HTMLElement).render(
  <React.StrictMode>
    <Auth0Provider
      domain="dev-mychhcrwjquf7khu.us.auth0.com"
      clientId="FEpuuEnR1NIhmKqANlrngVoIG5C09Ll0"
      authorizationParams={{
        redirect_uri: window.location.origin,
        audience: 'https://dev-mychhcrwjquf7khu.us.auth0.com/api/v2/',
        scope: 'read:current_user update:current_user_metadata',
      }}
    >
      <App />
    </Auth0Provider>
  </React.StrictMode>,
);
