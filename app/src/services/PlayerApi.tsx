import {
  archetypeResource,
  createPlayerParams,
  getUserByAuthParams,
  playerResource,
  updatePlayerParams,
} from './DTOs';

export async function getPlayer(playerId: number): Promise<playerResource> {
  const url = `${import.meta.env.VITE_BACK_END_URL}/api/players/${playerId}`;
  return await fetch(url, {
    headers: {
      'Content-Type': 'application/json',
    },
    method: 'GET',
  })
    .then(response => response.json())
    .then((data: playerResource) => {
      console.log('Success:', data);
      return data;
    })
    .catch(error => {
      console.error('Error:', error);
      throw error;
    });
}

export async function getPlayerByAuth(
  params: getUserByAuthParams,
): Promise<playerResource> {
  const url = `${import.meta.env.VITE_BACK_END_URL}/api/playersAuth`;
  return await fetch(url, {
    headers: {
      'Content-Type': 'application/json',
    },
    method: 'POST',
    body: JSON.stringify(params),
  })
    .then(response => response.json())
    .then((data: playerResource) => {
      console.log('Success:', data);
      return data;
    })
    .catch(error => {
      console.error('Error:', error);
      throw error;
    });
}

export async function getArchetypes(): Promise<archetypeResource[]> {
  const url = `${import.meta.env.VITE_BACK_END_URL}/api/archetypes`;
  return await fetch(url, {
    headers: {
      'Content-Type': 'application/json',
    },
    method: 'GET',
  })
    .then(response => response.json())
    .then((data: archetypeResource[]) => {
      console.log('Success:', data);
      return data;
    })
    .catch(error => {
      console.error('Error:', error);
      throw error;
    });
}

export async function createPlayer(
  params: createPlayerParams,
): Promise<playerResource> {
  const url = `${import.meta.env.VITE_BACK_END_URL}/api/players`;
  return await fetch(url, {
    headers: {
      'Content-Type': 'application/json',
    },
    method: 'POST',
    body: JSON.stringify(params),
  })
    .then(response => response.json())
    .then((data: playerResource) => {
      console.log('Success:', data);
      return data;
    })
    .catch(error => {
      console.error('Error:', error);
      throw error;
    });
}

export async function updatePlayer(
  params: updatePlayerParams,
): Promise<playerResource> {
  const url = `${import.meta.env.VITE_BACK_END_URL}/api/players`;
  return await fetch(url, {
    headers: {
      'Content-Type': 'application/json',
    },
    method: 'PUT',
    body: JSON.stringify(params),
  })
    .then(response => response.json())
    .then((data: playerResource) => {
      console.log('Success:', data);
      return data;
    })
    .catch(error => {
      console.error('Error:', error);
      throw error;
    });
}
