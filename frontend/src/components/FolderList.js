import React from 'react';

const FolderList = ({ folders, onSelect }) => {
  return (
    <div>
      <h2>Folder</h2>
      <ul>
        {folders.map(folder => (
          <li key={folder.id} onClick={() => onSelect(folder)}>
            {folder.name}
          </li>
        ))}
      </ul>
    </div>
  );
};

export default FolderList;
