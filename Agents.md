# 🤖 AI Multi-Agent System Architecture

This directory outlines the AI Multi-Agent system integrated into our Enterprise School Management System & LMS. The architecture uses an asynchronous, event-driven model powered by **Python (LangGraph/LangChain)** on the backend, **Celery/Redis** for job queueing, and a streaming WebSocket interface in **React** for user interaction.

---

## 🏗️ Core Architecture Overview

Our system shifts away from basic LLM prompts into dedicated, autonomous agents with specialized tools, memory states, and guardrails.

---

## 👥 Specialized System Agents

### 1. 📝 The Academic & Curriculum Agent (`academic_agent.py`)
Assists teachers in generating curricula, mapping lesson structures, and grading qualitative submissions against standard rubrics.

*   **Tools Authorized:**
    *   `CourseModelTool`: Creates and structuralizes JSON schemas compatible with our PostgreSQL database.
    *   `S3UploaderTool`: Converts generated reading structures into markdown files directly uploaded to cloud storage.
*   **Workflow:**
    1.  Receives educational constraints (e.g., "K-12 Grade 10 Algebra, 4-week timeline").
    2.  Generates organized Modules and Lessons based on local academic benchmarks.
    3.  Pushes structural data directly into Django models via our REST API.

### 2. 📊 The Financial & Operational Analyst Agent (`finance_agent.py`)
Monitors operational irregularities, flags student attrition factors, processes natural language financial inquiries, and audits transaction balances.

*   **Tools Authorized:**
    *   `PostgreSQLReadOnlyTool`: Formulates and safely executes localized raw SQL count/join algorithms.
    *   `StripeInvoiceAuditTool`: Validates real-time clearing statuses across external webhooks.
*   **Workflow:**
    1.  Admin asks: *"Show me all class sectors tracking a fee deficit over 15% this quarter."*
    2.  The agent translates the prompt to safe SQL query subsets scoped to the tenant ID.
    3.  Outputs structured charts rendered natively in React via Tremor.

### 3. 🎓 The Adaptive Student Support Agent (`student_agent.py`)
Acts as a 24/7 personal tutor for enrolled learners, serving specialized lesson summaries, quizzing based on progress data, and escalating bottlenecks.

*   **Tools Authorized:**
    *   `ProgressTrackerTool`: Pulls student lesson progress logs from PostgreSQL.
    *   `EscalationTool`: Dynamically raises flags to the Instructor Dashboard when a student fails a concept quiz three times.
*   **Workflow:**
    1.  Student requests a deep-dive breakdown of a complex video lecture block.
    2.  Agent reads the lecture text transcripts stored on AWS S3.
    3.  Outputs localized micro-quizzes, adapting difficulty depending on user history.

---

## 🛠️ Tech Stack & Configurations

### Dependencies
The backend requires the following Python libraries installed via Poetry:
```bash
poetry add langgraph langchain-openai langchain-community chromadb
```

### Environment Variables (`backend/.env`)
Ensure your localized agent variables are accurately bound before launching:
```env
OPENAI_API_KEY=sk-proj-...
LLM_MODEL_NAME=gpt-4o-mini
AGENT_MAX_LOOPS=5
VECTOR_DB_PATH=/app/chroma_db
```

---

## 🚀 Execution & Integration Setup

### 1. Backend Service Implementation (Django Rest Framework)
Agents execute as decoupled micro-services triggered via Celery tasks to avoid blocking the main server thread.

```python
# backend/agents/tasks.py
from celery import shared_task
from .orchestrator import SchoolAgentOrchestrator

@shared_task
def run_autonomous_agent_job(user_id, tenant_id, prompt, agent_type):
    orchestrator = SchoolAgentOrchestrator(tenant_id=tenant_id)
    response = orchestrator.route_and_execute(agent_type, prompt, user_id)
    return response
```

### 2. Frontend Real-time Streaming UI (React & WebSockets)
To build fluid dashboard assistant chat bars, capture streamed token fragments:

```javascript
// frontend/src/components/AgentChat.jsx
import React, { useState } from 'react';
import { useWebSocket } from '../hooks/useWebSocket';

export const AgentChat = () => {
  const [messages, setMessages] = useState([]);
  const { sendJsonMessage, lastJsonMessage } = useWebSocket('ws://localhost:8000/ws/agents/');

  // Captures incremental token sequences streamed live from Python LangGraph
  React.useEffect(() => {
    if (lastJsonMessage) {
      updateChatBubble(lastJsonMessage);
    }
  }, [lastJsonMessage]);

  return <div className="agent-container">...</div>;
};
```

---

## 🛡️ Guardrails, Security & Multi-Tenancy

To prevent security cross-contamination in an enterprise SaaS school infrastructure, our agent nodes follow strict structural policies:

*   **Tenant Data Isolation:** Every database query mapping tool explicitly demands and hardcodes the active `tenant_id` context. Agents cannot dynamically rewrite or inject data into other schools' tables.
*   **Read-Only Database Scoping:** The Financial Analyst Agent is completely prohibited from running `DROP`, `DELETE`, or `UPDATE` queries on raw tables.
*   **Prompt-Injection Sanitization:** Input prompts are sanitized via an intermediate regex abstraction node to filter out rogue script execution requests before passing values downstream to the LLM core.
