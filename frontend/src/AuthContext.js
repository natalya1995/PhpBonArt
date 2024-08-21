import React, { createContext, useState, useEffect } from 'react';
import { useNavigate } from 'react-router-dom';

const AuthContext = createContext();

const AuthProvider = ({ children }) => {
  const [user, setUser] = useState(null);
  const navigate = useNavigate();

  useEffect(() => {
    const token = localStorage.getItem('token');
    const userId = localStorage.getItem('user_id');
    if (token&&userId) {
     
      setUser({ id: userId, token });
    }

    const logoutTimer = setTimeout(() => {
      logout();
    }, 3600000); 

    return () => clearTimeout(logoutTimer);
  }, []);

  const login = (user, token) => {
    localStorage.setItem('token', token);
    localStorage.setItem('user_id', user.id); 
    setUser(user);

 
    const logoutTimer = setTimeout(() => {
      logout();
    }, 3600000);

    return () => clearTimeout(logoutTimer);
  };

  const logout = () => {
    localStorage.removeItem('token');
    localStorage.removeItem('user_id'); 
    setUser(null);
    navigate('/login');
  };

  return (
    <AuthContext.Provider value={{ user, login, logout }}>
    {children}
  </AuthContext.Provider>
  );
};

export { AuthContext, AuthProvider };
