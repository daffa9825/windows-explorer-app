import React, { useState, useEffect } from 'react';
import FolderList from './components/FolderList';
import SubFolder from './components/SubFolder';
import './App.css';

const App = () => {
  const [folders, setFolders] = useState([]);
  const [selectedFolder, setSelectedFolder] = useState(null);
  const [loading, setLoading] = useState(true);
  const [error, setError] = useState(null);

  useEffect(() => {
    fetch('http://127.0.0.1:8000/api/folder')
      .then(response => response.json())
      .then(data => {
        if (data.status === 'success') {
          setFolders(data.data);
        } else {
          setError(data.message);
        }
      })
      .catch(error => setError('Error fetching data: ' + error))
      .finally(() => setLoading(false));
  }, []);

  if (loading) return <div>Loading...</div>;
  if (error) return <div>Error: {error}</div>;

  return (
    <div className="app">
      <div className="left-panel">
        <FolderList folders={folders} onSelect={setSelectedFolder} />
      </div>
      <div className="right-panel">
        <SubFolder folder={selectedFolder} />
      </div>
    </div>
  );
};

export default App;
