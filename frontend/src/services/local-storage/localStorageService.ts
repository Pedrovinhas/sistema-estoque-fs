const get = <T>(key: string): T | null => {
  const value = localStorage.getItem(key);

  const data: T | null = value !== null ? JSON.parse(value) : null;

  return data;
};

const set = <T>(key: string, value: T) => {
  localStorage.setItem(key, JSON.stringify(value));
};

const clear = (key: string) => {
  localStorage.removeItem(key);
};

export default {
  get,
  set,
  clear,
};
