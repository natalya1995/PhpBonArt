import React, { createContext, useState, useEffect } from 'react';
import { useNavigate } from 'react-router-dom';

const AuthContext = createContext();

const AuthProvider = ({ children }) => {
  const [user, setUser] = useState(null);
  const navigate = useNavigate();

  useEffect(() => {
    const token = localStorage.getItem('token');
    if (token) {
     
      setUser({ token });
    }

    const logoutTimer = setTimeout(() => {
      logout();
    }, 3600000); 

    return () => clearTimeout(logoutTimer);
  }, []);

  const login = (user, token) => {
    localStorage.setItem('token', token);
    setUser(user);

 
    const logoutTimer = setTimeout(() => {
      logout();
    }, 3600000);

    return () => clearTimeout(logoutTimer);
  };

  const logout = () => {
    localStorage.removeItem('token');
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
