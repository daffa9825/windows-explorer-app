import React, { useState, useEffect } from 'react';

const SubFolder = ({ folder }) => {
  const [subFolders, setSubFolders] = useState([]);

  useEffect(() => {
    if (folder) {
      fetch(`http://127.0.0.1:8000/api/${folder.id}/sub_folder`)
        .then(response => response.json())
        .then(data => {
          if (data.status === 'success') {
            setSubFolders(data.data.sub_folders || []);
          } else {
            console.error('Error fetching subfolder data:', data.message);
          }
        })
        .catch(error => console.error('Error fetching subfolder data:', error));
    }
  }, [folder]);

  return (
    <div>
      <h2>Sub Folder</h2>
      {folder ? (
        <div>
          {subFolders.length > 0 ? (
            <table>
              <thead>
                <tr>
                  <th>Name</th>
                  <th>Type</th>
                  <th>Size</th>
                  <th>Modified Date</th>
                </tr>
              </thead>
              <tbody>
                {subFolders.map(subfolder => (
                  <tr key={subfolder.id}>
                    <td>{subfolder.name}</td>
                    <td>{subfolder.type}</td>
                    <td>{subfolder.size}</td>
                    <td>{new Date(subfolder.updated_at).toLocaleDateString()}</td>
                  </tr>
                ))}
              </tbody>
            </table>
          ) : (
            <p>No Sub Folder</p>
          )}
        </div>
      ) : (
        <p></p>
      )}
    </div>
  );
};

export default SubFolder;
