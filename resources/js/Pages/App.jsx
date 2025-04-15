import React from 'react';
import { LoadingProvider } from '../contexts/LoadingContext';
import Loading from '../Components/Loading';
import Layout from '../Components/Layout';

function App({ children }) {
  return (
    <LoadingProvider>
      <Layout>
        {children}
      </Layout>
      <Loading />
    </LoadingProvider>
  );
}

export default App;
